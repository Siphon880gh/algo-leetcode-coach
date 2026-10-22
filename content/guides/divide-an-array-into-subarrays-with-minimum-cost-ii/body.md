## Two multisets

1. Over b = nums[1 …], slide a window of width dist + 1.
2. Keep the window split into L (its k − 1 smallest, with their sum) and the rest H. On each insert or delete, rebalance so |L| = k − 1 and max(L) ≤ min(H).
3. Answer = nums[0] + the smallest sum of L over all windows.

Examples → 5, 15, 36. Checked against trying every choice of starts on 1,500 random small arrays.

The dist rule matters: ignoring it gives example 3 → 27 instead of 36. Sums reach about 10^14; use 64-bit.

Time: O(n log n)  
Space: O(n)

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
