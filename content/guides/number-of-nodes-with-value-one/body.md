Nodes labelled 1 … n form a rooted tree with the shape the statement describes. Every node starts with value 0. Each query names a node and flips the value of every node in its subtree. Return how many nodes hold 1 after all queries. For instance, querying the same node twice leaves every value at 0, so the answer is 0, and querying the root once turns all n nodes to 1, so the answer is n. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Parity down the tree

1. `f[q] ^= 1` for each query `q`.
2. Visit the nodes from the root down, in any order that reaches a parent before its children (BFS works): `val[v] = f[v] XOR val[parent(v)]`, with the root’s missing parent counting as 0.
3. Return the number of `v` with `val[v] = 1`.

Constructed checks (verified against flipping every subtree directly on 300 random trees): the same node twice → 0; the root once → n; the root and then one leaf → n − 1.

A node ends at 1 exactly when an odd number of the queries that cover it were made, and those are the queries on it and its ancestors. Flipping whole subtrees per query costs up to O(n) each, which is too slow when both n and the number of queries are large.

Time: O(n + q)  
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
