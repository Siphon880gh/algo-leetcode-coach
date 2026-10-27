Given a string `text` and a list of `words`, return every pair `[i, j]` such that `text[i..j]` (inclusive) is one of the words, sorted by `i` and then by `j`. `text = "thestoryofleetcodeandme"`, `words = ["story","fleet","leetcode"]` → `[[3,7],[9,13],[10,17]]`. `text = "ababa"`, `words = ["aba","ab"]` → `[[0,1],[0,2],[2,3],[2,4]]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One walk per start

1. Insert every word into a trie with an end flag.
2. For each `i` from 0: `node = root`; for `j` from `i`: move to `node.child[text[j]]` (stop if missing); if the node ends a word, append `[i, j]`.

Starts go in increasing order and each walk extends `j` in increasing order, so the output is already sorted.

Do not run `text.find(word)` for each word and sort afterward unless you also catch every overlapping occurrence; the trie walk finds them all. Do not stop a walk at the first word end; a longer word may continue from it.

Time: O(n · L), L = longest word  
Space: O(total word length)

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
