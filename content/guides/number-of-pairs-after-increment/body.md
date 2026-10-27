## Blocks

1. Blocks of size S ≈ √n, each with lazy[b] and cnt[b] (value → count).
2. Add [x, y, val]: full blocks get lazy += val; partial blocks update elements and counts one by one.
3. Query tot: Σ over nums1 values a and blocks b of cnt[b][tot − a − lazy[b]].

Examples → [2, 1], [2, 6], [1, 0]. Checked against direct updates on 500 random cases with several block sizes.

Deduplicating nums1: example 2 → [1, 3] instead of [2, 6].

Time: O(q · (S + 5 · n / S)) = O(q √n)  
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
