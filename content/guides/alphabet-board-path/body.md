## Coordinates per letter

For letter `ch`, `idx = ord(ch) − ord("a")`, `r = idx // 5`, `c = idx % 5`. Start at `(0, 0)`.

For each target `(tr, tc)`:

1. While `r > tr`: `U`. While `c > tc`: `L`.
2. While `r < tr`: `D`. While `c < tc`: `R`.
3. Append `!`.

Going to `z`, moving left before down keeps you on the board; leaving `z`, moving up before right does the same.

Do not move down and right first; from `e` to `z`, stepping down first lands on a missing cell in the last row. Any shortest path is accepted.

Time: O(len(target))  
Space: O(len(target))

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
