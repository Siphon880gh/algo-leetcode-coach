There are n houses. Building a well in house i costs a given amount, and a pipe between two houses has a given cost. Return the minimum total cost to supply water to every house. For instance, with 3 houses, well costs `[1,2,2]`, and pipes `[[1,2,1],[2,3,1]]`, the answer is 3: one well in house 1 and both pipes. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One MST

1. Edges: `(0, i, wells[i − 1])` for each house, plus every pipe.
2. Sort edges by cost and union with a DSU, adding the cost when two sets merge.
3. Stop after n unions (n + 1 nodes) and return the total.

Every house is either on a well (edge to node 0) or piped to one, which is exactly a spanning tree containing node 0.

Do not choose the cheapest well first and then build an MST of pipes; several wells may beat long pipes. Do not forget that pipes can repeat between the same houses; Kruskal handles that.

Time: O((n + p) log (n + p))  
Space: O(n + p)

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
