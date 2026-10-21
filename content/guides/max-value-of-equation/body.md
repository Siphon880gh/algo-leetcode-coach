## Split the expression

1. For each `(x, y)`: pop the front while `x − front.x > k`.
2. If the deque is non-empty: `best = max(best, front.(y − x) + y + x)`.
3. Pop the back while `back.(y − x) ≤ y − x`; push `(y − x, x)`.

`[[1,3],[2,0],[5,10],[6,-10]]`, k = 1 → 4. `[[0,0],[3,0],[9,2]]`, k = 3 → 3.

Do not push the current point before querying; i must be strictly before j. A max-heap with lazy removal gives O(n log n).

Time: O(n)  
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
