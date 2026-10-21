Given pairs of synonymous words (synonymy is transitive) and a sentence, return every sentence you can make by replacing words with their synonyms, sorted lexicographically. For instance, synonyms `[["happy","joy"]]` and the text `"I am happy"` give `["I am happy","I am joy"]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Groups, then all choices

1. DSU over words in the pairs; collect each root's members and sort them.
2. Backtrack over the sentence words: if a word is in a group, try every member; else keep it.
3. Join each full choice with spaces and sort the results.

Transitivity matters: with `a ~ b` and `b ~ c`, `a` can become `c`.

Do not replace only with direct pairs; use the whole group. Do not forget to sort; the output must be in lexicographic order.

Time: O(product of group sizes · sentence length)  
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
