## Union until it fails

A tree with one extra edge has exactly one cycle. Process edges in input order:

- `find(u) == find(v)`: `u` and `v` are already connected, so this edge closes the cycle. Return it.
- Otherwise, `union(u, v)`.

The problem asks for the cycle edge that appears **last** in the input. Every other cycle edge comes earlier and was merged before the closing one, so the first failure is exactly that edge.

Use path compression and union by rank to get near-constant time per operation. A DFS check before each edge is O(n²) and also works for `n ≤ 1000`.

Do not return the first edge of the cycle; it must be the last one in the input. Do not mix this up with problem 685, where edges are directed.

Time: O(n · α(n))  
Space: O(n)

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
