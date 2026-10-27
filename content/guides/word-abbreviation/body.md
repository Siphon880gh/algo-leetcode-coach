`words` has 1 to 400 distinct words, each 2 to 400 lowercase letters. A word's abbreviation starts as first letter + number of middle letters + last letter (`"internet"` → `"i6t"`). While several words share an abbreviation, all of them grow their prefix by one letter. Finally, if an abbreviation is not shorter than its word, use the word. `["like","god","internal","me","internet","interval","intension","face","intrusion"]` → `["l2e","god","internal","me","i6t","interval","inte4n","f2e","intr4n"]`. `["aa","aaa"]` → `["aa","aaa"]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Who can clash, and how long the prefix must be

Two abbreviations with prefix length `p` are equal only if the words have the same length, the same last letter, and the same first `p` letters. So group words by `(len, first, last)`; groups never interact.

Inside a group, a word's prefix must be longer than its longest common prefix with every other word in the group: `p = 1 + max LCP`. Growing all clashing words together reaches exactly that.

Find max LCP either with a trie per group (store a count on each node; walk the word until a node's count is 1 — that depth is `p`), or by sorting the group: the max LCP is with a sorted neighbor.

Then `abbr = word[:p] + str(len − p − 1) + word[-1]`, and use `word` if `len(abbr) >= len(word)`. `"internal"` vs `"interval"`: LCP 5, `p = 6`, `"intern1l"` is 8 letters → keep `"internal"`.

Do not compare a word against words of other lengths or end letters — they never clash. Do not abbreviate when it does not save letters.

Time: O(total letters · log) with sorting, O(total letters) with tries  
Space: O(total letters)

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
