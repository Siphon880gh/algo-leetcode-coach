## Key = (count, index)

1. For each row, find the first 0 by binary search; that index is the soldier count.
2. Sort `(count, i)` and take the first `k` indices.

First example, k = 3 → `[2,0,3]`. Second, k = 2 → `[0,2]`.

Do not break ties by larger index; the smaller index is weaker. Do not count each row linearly if rows are long; binary search uses the sorted shape.

Time: O(m log n + m log m)  
Space: O(m)

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
