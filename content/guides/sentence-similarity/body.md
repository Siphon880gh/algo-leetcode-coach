Two sentences are given as word arrays, with a list of similar word pairs. They are similar if they have the same length and, at every position, the words are equal or form a similar pair (in either order). Similarity is not transitive. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## A set of pairs

1. If the sentences have different lengths, return false.
2. Build a set holding `(a, b)` and `(b, a)` for every similar pair.
3. For each position `i`: pass if `w1 == w2`; otherwise require `(w1, w2)` in the set.

Every word is similar to itself even if it never appears in the pair list.

Similarity is **not** transitive here: `a~b` and `b~c` do not make `a~c`. That is the difference from problem 737, which needs union-find.

Do not add only one direction of each pair. Do not use union-find; it would wrongly link words through chains.

Time: O(n + p), for p pairs  
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
