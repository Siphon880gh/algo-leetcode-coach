Given a list of phrases, a before-and-after puzzle joins two different phrases where the last word of the first equals the first word of the second, writing the shared word once. Return all distinct puzzles in lexicographic order. For instance, `["writing code","code rocks"]` gives `["writing code rocks"]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map first words

1. `first[w]` = indices of phrases whose first word is `w`.
2. For each phrase `i` with last word `lw`: for each `j` in `first[lw]` with `j ≠ i`, add `phrase_i + phrase_j[len(lw):]`.
3. Return the sorted distinct results.

`["a b","b a"]` → `["a b a","b a b"]`.

Do not pair a phrase with itself; the two phrases must be different entries. Do not join with the word written twice. Do not forget to remove duplicates.

Time: O(n² · L) worst case, plus sorting  
Space: O(output)

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
