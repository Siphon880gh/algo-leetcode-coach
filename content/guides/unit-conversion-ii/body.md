There are n unit types, 0 … n − 1, and n − 1 conversions; each one says a single unit of a source type equals some integer number of units of a target type, and together they connect every type exactly one way. For each query (a, b), return how many units of b equal one unit of a. The answer can be a fraction p/q, so report it as p · q⁻¹ modulo 10^9 + 7. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Ratios from the root

1. Build an undirected list: a → b with factor f, and b → a with inverse(f).
2. DFS or BFS from 0: val[0] = 1, val[v] = val[u] · factor mod 10^9 + 7.
3. Answer val[b] · val[a]^(10^9 + 5) mod 10^9 + 7 for each query (Fermat inverse).

Constructed checks (run in code): conversions [[0, 1, 3], [1, 2, 4]], queries [[0, 2], [2, 0], [1, 1]] → [12, 83333334, 1]; 83333334 is the inverse of 12.

Dividing as plain integers instead of using the modular inverse: the same check → [12, 0, 1].

Time: O(n + q log M), M = 10^9 + 7  
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
