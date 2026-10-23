## Cost per index

1. c[i] = max(0, max(nums[i − 1], nums[i + 1]) + 1 − nums[i]).
2. Odd n → Σ c[1], c[3], …, c[n − 2].
3. Even n → min over s of (first s odd indices 1, 3, …) + (even indices from 2s + 2 to n − 2), using prefix sums.

Raising a chosen index never affects another chosen index, since they are not adjacent.

Examples → 1, 2, 4. Checked against trying every set of increments on 400 random arrays.

Using only all-odd or all-even indices for even n: constructed check (run in code) [5, 7, 5, 4, 5, 4, 6, 8] → 5 instead of 3.

Time: O(n)  
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
