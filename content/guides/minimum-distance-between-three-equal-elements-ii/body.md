## Positions by value

1. pos[v] = indices of v in order.
2. answer = min over v and t of 2 · (pos[v][t + 2] − pos[v][t]).
3. Return it, or −1.

Examples → 6, 8, −1 (same examples as part I). Checked against testing every triple on 3,000 random arrays.

Using only the first three positions of each value: constructed check (run in code) [1, 2, 3, 1, 4, 5, 1, 1, 2, 6, 2] → 12 instead of 8.

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
