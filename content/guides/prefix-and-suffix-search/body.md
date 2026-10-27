## Glue the suffix in front

For word `w` at index `i`, insert `w[j:] + "#" + w` for every `j` from 0 to `|w|`. Each trie node keeps `best = i`; later words overwrite it, so the node holds the largest index.

`f(pref, suff)`: walk `suff + "#" + pref`. If the walk breaks, return `-1`; otherwise return the node's `best`.

Why it works: a path through `suff#pref` exists exactly when some word ends with `suff` (the part before `#`) and starts with `pref` (the part after, which is a prefix of the word).

Words have at most 7 letters, so a hash map of every (prefix, suffix) pair (at most 64 keys per word) is an equally valid simple design.

Do not answer each query by scanning all words; that is O(N) per call with up to 10⁴ calls. Do not keep the smallest index; the problem asks for the largest.

Time: O(N · L²) build, O(L) per query  
Space: O(N · L²)

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
