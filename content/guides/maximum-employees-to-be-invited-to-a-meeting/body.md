## Two kinds of tables

1. Peel the trees with Kahn's algorithm on in-degrees, recording `depth[v]` = longest chain ending at `v` (counting `v`).
2. The remaining nodes form cycles. For a cycle of length ≥ 3, candidate = its length (no extra chains fit).
3. For each 2-cycle `(a, b)`: add `depth[a] + depth[b]`; sum this over all 2-cycles.
4. Return `max(largest cycle, sum over 2-cycles)`.

Examples → 3, 3, 4. Checked against trying every seating on small random inputs.

In a cycle of length ≥ 3 everyone's two neighbours are taken, so nobody else can join. A mutual pair only needs to sit together, which leaves the outer ends free for chains, and several such lines can be placed one after another around the table.

Time: O(n)  
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
