## Biggest cut each time

1. `target = sum / 2`, `cut = 0`, max-heap of values.
2. While `cut < target`: pop `x`, `cut += x / 2`, push `x / 2`, count an operation.
3. Return the count.

Examples → 3, 3.

Halving the largest value removes the most possible in one step, and a halved value stays in play for later operations. Use doubles (or scale values by 2^20) since halves are fractional.

Time: O(n + ops · log n), ops ≤ n  
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
