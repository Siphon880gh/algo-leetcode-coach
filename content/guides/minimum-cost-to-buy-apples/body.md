Cities are joined by two-way roads, each with a travel cost, and every city sells apples at its own price. From a starting city you travel to any city, buy one apple, and travel back, where the way back costs the way there times a given factor k; the exact rule is in the official statement. For each starting city, return the least total cost. For instance, two cities joined by a road of cost 2, with prices [10,3] and k = 2 → [9,3]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Prices as starting distances

1. Edge weight `w · (1 + k)`.
2. `d[c] = price[c]` for every city; push them all into a min-heap.
3. Run Dijkstra; return `d`.

Constructed checks (verified against one Dijkstra per starting city on 300 random graphs): the case above → [9,3]; a path 0 – 1 – 2 with road costs 1, prices [20,9,1] and k = 1 → [5,3,1].

The round trip to c is (1 + k) · dist(start, c), and dist is symmetric, so the cost from start equals a shortest path from a virtual source linked to each c at cost price[c]. That turns n Dijkstras into one.

Time: O((n + m) log n)  
Space: O(n + m)

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
