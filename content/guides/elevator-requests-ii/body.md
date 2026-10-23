## Interval DP

1. Sort the request floors together with start. A request on start is served at time 0.
2. dp[l][r][side] = least penalty after serving every request between positions l and r, standing at the left (side 0) or right (side 1) end.
3. Extend by one floor on either side: add distance · (requests not yet served).
4. Answer = min(dp[0][last][0], dp[0][last][1]).

Examples → 6, 10, 22. Matched trying every order on 800 random cases.

Always going to the nearest unserved floor: constructed check (run in code) start = 8, requests = [7, 2, 9, 6, 8] → 20 instead of 16.

Time: O(m²)  
Space: O(m²), or O(m) keeping one interval length at a time

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
