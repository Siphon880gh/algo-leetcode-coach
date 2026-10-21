## Greedy on diminishing returns

1. Push every class with key `−gain(p, t)`.
2. For each extra student: pop the top, `p += 1`, `t += 1`, push back with the new gain.
3. Return the mean of `p / t`.

Example 1 → 0.78333. Example 2 → 0.53485.

Greedy is optimal because each class's gain decreases with every student added. Do not sort by current ratio; a class at 2/2 gains nothing.

Time: O((n + extra) log n)  
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
