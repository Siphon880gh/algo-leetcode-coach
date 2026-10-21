Like Sentence Similarity, two word arrays are similar if they have the same length and each pair of words at the same position is similar, but now similarity is transitive: if `a~b` and `b~c`, then `a~c`. Every word is similar to itself. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Transitive means components

1. If the lengths differ, return false.
2. For each pair `(a, b)`: `union(a, b)`, creating entries for new words on the fly (a map from word to parent).
3. For each position: pass if `w1 == w2`; otherwise require that both words are known and `find(w1) == find(w2)`.

Transitivity turns the pairs into a graph, and similar words are those in the same connected component. Union-find answers each query in near-constant time.

A DFS or BFS per query also works, but costs O(p) each.

Do not use the set-of-pairs check from problem 734; it misses chains like `great~good~fine`. Do not crash on a word that never appears in any pair; it is similar only to itself.

Time: O((p + n) · α(p))  
Space: O(p)

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
