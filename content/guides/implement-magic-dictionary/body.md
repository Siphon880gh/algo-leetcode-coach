## Count mismatches

`buildDict` stores the words in a map from length to a list of words.

`search(w)`: for each stored word of length `|w|`, count the positions that differ. Stop past 1. Return true if some word has **exactly** 1.

A faster lookup stores generalized neighbors: for each word and position `i`, the key `word[:i] + "*" + word[i+1:]` maps to the count, plus which original letter was there. A search matches if some key exists with a different letter at the starred position. Keep the original letters so a word does not match itself.

Do not return true for 0 differences; the search word must be changed. Do not compare words of different lengths; a change replaces a letter and never adds or removes one.

Time: O(Σ len) build, O(words · len) search (or O(len²) with neighbor keys)  
Space: O(Σ len)

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
