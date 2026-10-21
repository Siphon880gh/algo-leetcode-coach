## Fix the largest side

After sorting, `a ≤ b ≤ c` forms a triangle exactly when `a + b > c`; the other two inequalities hold automatically.

For each `k` from `n − 1` down to 2 (side `c = nums[k]`), set `i = 0`, `j = k − 1`:

- If `nums[i] + nums[j] > nums[k]`, then every index from `i` to `j − 1` paired with `j` works too: add `j − i`, then `j -= 1`.
- Otherwise `nums[i]` is too small for this `j`: `i += 1`.

Fixing the two smaller sides and binary searching for the largest valid third side is O(n² log n).

Do not count side lengths of 0 as valid; `0 + b > c` fails when `b ≤ c` anyway, and the sort handles it. Do not try all triples; O(n³) is too slow at n = 1000.

Time: O(n²)  
Space: O(1) beyond sorting

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
