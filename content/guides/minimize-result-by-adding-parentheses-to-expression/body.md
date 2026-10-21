## All placements

1. Split at `+` into `x`, `y`.
2. For `i = 0 … |x| − 1`, `j = 1 … |y|`: `a = x[0 … i)` (or 1 if empty), `d = y[j …]` (or 1 if empty).
3. Value `a · (x[i …] + y[0 … j)) · d`; keep the smallest and rebuild the string.

Examples → `2(47+38)`, `1(2+3)4`, `(999+999)`.

An empty outer part means no multiplication, which is why it counts as 1. At most 64 placements are tried.

Time: O(|x| · |y| · len)  
Space: O(len)

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
