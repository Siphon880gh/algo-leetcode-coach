Given a binary grid, count the distinct island shapes, where two islands count as the same if one can be turned into the other by translation, any rotation by 90°, 180°, or 270°, or a reflection (left-right or up-down). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Canonicalize each shape

1. Flood-fill each island into a list of `(r, c)` cells.
2. Build the 8 variants `(±r, ±c)` and `(±c, ±r)`, which cover every rotation and reflection.
3. Normalize each variant: sort its cells, then subtract the first cell from all of them so the shape starts at `(0, 0)`.
4. The island's key is the smallest of the 8 normalized lists (compare them as tuples).
5. Put the key in a set; the answer is the set's size.

Any two equivalent islands produce the same 8 variants (in a different order), so they share the same minimum.

Do not compare islands pairwise under all transforms; picking one canonical form makes hashing possible. Do not normalize by the minimum row and column separately before sorting; shifting by the first sorted cell is simpler and consistent.

Time: O(m · n · log(m · n)) for sorting the variants  
Space: O(m · n)

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
