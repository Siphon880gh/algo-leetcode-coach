## Bitmask DP

1. f[{j}][j] = max(|start − floor_j|, arrival_j).
2. f[mask][j] = min over k in mask \ {j} of max(f[mask \ {j}][k] + |floor_k − floor_j|, arrival_j).
3. Return min over j of f[all][j].

Examples → 9, 7, 8. Matched Dijkstra over (floor, served set) on 700 random cases.

Serving requests in arrival order: example 1 → 11 instead of 9.

Time: O(m² · 2^m)  
Space: O(m · 2^m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
