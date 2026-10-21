## Solve the system

1. If `T` is odd, return `[]`.
2. `j = T / 2 − C`, `s = C − j`.
3. If `j < 0` or `s < 0`, return `[]`; else `[j, s]`.

`T = 16, C = 7` → `[1,6]`. `T = 17, C = 4` → `[]`. `T = 4, C = 17` → `[]`.

Do not search over all counts; the system has one solution. Do not forget the parity check; tomato slices come in pairs.

Time: O(1)  
Space: O(1)

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
