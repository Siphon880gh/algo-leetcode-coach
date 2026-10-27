## Count while merge sorting

`sort(l, r)` returns the count inside `[l, r]` and leaves it sorted. Split at `mid`, recurse on both halves (each now sorted). Every cross pair has `i` in the left half and `j` in the right. Walk `j` over the right half and a pointer `i` over the left: advance `i` while `nums[i] <= 2 · nums[j]`. Then every left value from `i` to `mid` is a reverse pair with `j`, so add `mid − i + 1`. Since both halves are sorted, `i` only moves forward. Then merge the halves normally.

Counting must be a separate pass from merging: the merge compares `nums[i] <= nums[j]`, but the count uses `2 · nums[j]`.

Fenwick tree alternative: compress all values and all doubled values, scan from right to left, query how many seen values are less than `nums[i] / 2`, then add `nums[i]`.

Count of Smaller Numbers After Self (315) and Count of Range Sum (327) use the same merge-sort counting. Global and Local Inversions (775) is the `> nums[j]` version with a shortcut.

Do not compute `2 · nums[j]` in 32 bits — it overflows near ±2^31. Do not count during the merge itself with the merge comparison.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
