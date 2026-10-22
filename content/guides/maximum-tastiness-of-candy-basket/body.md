## Largest feasible gap

1. Sort `price`.
2. `ok(d)`: count greedily from the smallest, taking `x` when `x − last ≥ d`; return `count ≥ k`.
3. Binary search `d` in `[0, max − min]` for the largest `ok(d)`.

Examples → 8, 2, 0. Checked against trying every basket on 300 random small cases.

Taking the smallest possible next candy leaves the most room above it, so the greedy count is the most any choice can reach. Repeated prices give gap 0, which is why Example 3 → 0.

Time: O(n log n + n log(max price))  
Space: O(1) beyond sorting

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
