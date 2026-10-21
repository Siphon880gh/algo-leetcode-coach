## Vote for shifts

1. List the coordinates of ones in `A` and in `B`.
2. For every pair `(a, b)`, increment `count[(b.r − a.r, b.c − a.c)]`.
3. Return the maximum count, or 0 if there are no ones.

Each pair votes for the one shift that would put that 1 of `A` on that 1 of `B`, so a shift's vote count is exactly its overlap.

Cost is O(onesA · onesB), at most O(n⁴) = 810,000 for `n = 30`, and much less when the images are sparse.

**Brute force:** try all `(2n − 1)²` shifts and count overlaps in O(n²) each, also O(n⁴).

Do not allow rotation; only translation is permitted. Do not wrap around the edges; ones shifted out are lost.

Time: O(onesA · onesB)  
Space: O(n²) for the shift counts

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
