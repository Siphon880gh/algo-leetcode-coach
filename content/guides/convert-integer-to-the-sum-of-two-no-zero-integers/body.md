## Scan splits

1. For `a` from 1 to `n − 1`: if neither `a` nor `n − a` contains `0`, return `[a, n − a]`.

`n = 2` → `[1,1]`. `n = 11` → `[2,9]`. Any valid pair is accepted.

Do not stop at `a = 1`; `n − 1` may contain a 0, as in `11 − 1 = 10`. Do not check only the last digit; a zero can be anywhere.

Time: O(n · log n) worst case, fast in practice  
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
