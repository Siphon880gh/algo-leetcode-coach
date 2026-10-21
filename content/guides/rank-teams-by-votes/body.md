## Vector keys

1. `rank[team][p]` = number of votes placing `team` at position `p`.
2. Sort teams by `(−rank[team][0], −rank[team][1], …, team)`.

`["ABC","ACB","ABC","ACB","ACB"]` → `"ACB"`. `["WXYZ","XYZW"]` → `"XWYZ"`. A single vote returns that vote.

Do not sum points by position; the comparison is lexicographic on counts. Do not forget the alphabetical tie-break.

Time: O(votes · teams + teams² log teams)  
Space: O(teams²)

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
