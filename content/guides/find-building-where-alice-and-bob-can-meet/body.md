## Offline from the right

1. For each query sort so a ≤ b. If `a = b` or `h[a] < h[b]`, answer b.
2. Otherwise attach (h[a], query) to index b.
3. Sweep j from n − 1 down: answer queries at j by binary searching the stack (indices to the right, heights decreasing toward its top) for the nearest index with height > h[a]; then pop heights ≤ h[j] and push j.

Examples → [2, 5, −1, 5, 2], [7, 6, −1, 4, 6]. Checked against reachable-set intersection on 600 random inputs.

Moves need strictly greater heights: heights [3, 3, 5] with query [0, 1] → 2, not 1.

Time: O((n + q) log n)  
Space: O(n + q)

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
