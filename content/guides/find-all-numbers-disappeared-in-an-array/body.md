`nums` has length `n` (1 to 1e5) and every value is in `[1, n]`. Return every integer in `[1, n]` that does not appear. Follow-up: O(n) time and no extra space besides the output. `[4,3,2,7,8,2,3,1]` → `[5,6]`. `[1,1]` → `[2]`.

## Each value marks its own slot

Walk the array. For `x = |nums[i]|`, make `nums[x − 1]` negative (if it is already negative, leave it). After the pass, slot `i` is still positive exactly when the value `i + 1` never appeared. Collect those `i + 1`. Use the absolute value when reading, since earlier steps flip signs.

A hash set of the values works too but costs O(n) extra space. Cycle sort (swap each value to slot `value − 1`) also works.

Find All Duplicates in an Array (442) uses the same marking to report repeated values. Missing Number (268) has exactly one missing value in `[0, n]` and can use a sum or XOR.

Do not sort (O(n log n)). Do not index with a value that is already negative. Do not forget to restore signs if the caller needs the input unchanged.

Time: O(n)  
Space: O(1) extra

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
