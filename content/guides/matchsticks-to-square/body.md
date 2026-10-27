## Four buckets with pruning

Let `side = total / 4`. If `total % 4 != 0` or the longest stick is longer than `side`, return false.

Backtracking: sort sticks descending (long sticks fail fast). Keep `edges[0..3]`. For stick `u`, try adding it to each side where `edges[i] + stick <= side`; recurse to `u + 1`; undo. If two sides currently have the same length, trying the second one repeats the same search — skip it. When every stick is placed, all four sides equal `side`.

Bitmask DP alternative: for each mask of used sticks, store the length filled on the current side (`sum(mask) % side`). From a reachable mask, add an unused stick if it fits in what is left of the current side. Answer is whether the full mask is reachable. O(2^n · n).

Partition to K Equal Sum Subsets (698) is the general version — this is `k = 4`. Partition Equal Subset Sum (416) is `k = 2` and works with a sum DP.

Do not forget the divisibility and longest-stick checks. Do not try sticks in ascending order — it explodes. Do not skip the equal-side pruning.

Time: O(4^n) worst case for backtracking (O(2^n · n) with bitmask DP)  
Space: O(n) recursion (O(2^n) for the DP)

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
