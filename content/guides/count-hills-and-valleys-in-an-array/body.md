## Plateaus count once

1. `b` = `nums` with consecutive duplicates removed.
2. Count `i` in `1 … len(b) − 2` with `b[i]` above both or below both neighbours.

Examples → 3, 0.

Equal adjacent indices belong to the same hill or valley, so compressing counts a plateau once. The ends never count because they lack a neighbour on one side.

Time: O(n)  
Space: O(n), or O(1) by tracking the last different value

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
