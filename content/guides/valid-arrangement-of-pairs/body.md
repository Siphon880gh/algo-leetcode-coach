## Use every edge once

1. Build adjacency lists and `out − in` per vertex.
2. Start at the vertex with `out − in = 1`, else at `pairs[0][0]`.
3. Hierholzer: stack `[start]`; while non-empty, if the top has an unused edge, push its endpoint; else pop it onto `path`.
4. Reverse `path`; output `[path[i], path[i + 1]]`.

Examples → `[[11,9],[9,4],[4,5],[5,1]]`, `[[1,3],[3,2],[2,1]]`, `[[1,2],[2,1],[1,3]]`. Each output checked to use every pair once and chain correctly.

A valid arrangement is a path that uses every edge exactly once. A greedy walk can get stuck (Example 3 from 1 → 3 first); Hierholzer splices the missed cycles in. Write it iteratively for 10^5 edges.

Time: O(V + E)  
Space: O(V + E)

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
