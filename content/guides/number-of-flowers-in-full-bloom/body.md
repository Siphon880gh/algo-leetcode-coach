## Started minus finished

1. `S` = sorted starts, `E` = sorted ends.
2. For each `t`: `upper_bound(S, t) − lower_bound(E, t)`.

Examples → `[1,2,2,2]`, `[2,2,1]`.

Ends are inclusive, so a flower ending at `t` is still in bloom; that is why ends use `lower_bound` (strictly before `t`).

Time: O((F + P) log F)  
Space: O(F)

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
