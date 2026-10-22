## Gains per child

1. Post-order. base = Σ keep[c][1]; gain_c = w + keep[c][0] − keep[c][1].
2. Sort positive gains descending: keep[v][1] = base + top k, keep[v][0] = base + top k − 1.
3. Answer keep[root][1].

Examples → 22, 65. Checked against every edge subset on 400 random trees.

Keeping the k heaviest edges at each node separately: edges 1–0 (6), 2–0 (7), 3–1 (1), k = 1 → 7 instead of 8.

Time: O(n log n)  
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
