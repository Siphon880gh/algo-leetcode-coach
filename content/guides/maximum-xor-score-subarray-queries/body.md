## Two tables

1. s[i][i] = nums[i]; s[i][j] = s[i][j − 1] XOR s[i + 1][j].
2. best[i][j] = max(s[i][j], best[i][j − 1], best[i + 1][j]).
3. Answer best[l][r].

Examples → [12, 60, 60], [7, 14, 11, 14, 5]. Checked against simulating the reduction on 100 random queries.

Using the plain XOR of the subarray: example 1 → [14, 60, 63].

Time: O(n² + q)  
Space: O(n²)

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
