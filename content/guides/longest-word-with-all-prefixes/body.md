Given a list of words, find the longest word such that every one of its prefixes is also in the list; on ties return the lexicographically smallest, and return an empty string if there is none. For instance, [k, ki, kir, kira, kiran] → "kiran"; [a, banana, app, appl, ap, apply, apple] → "apple"; [abc, bc, ab, qwe] → "". _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check every prefix

1. `S = set(words)`.
2. For each `w`: if all `w[:i] ∈ S` for `1 ≤ i < len(w)`, compare with the best (longer, or equal length and smaller).

Constructed checks (verified with code): the three cases above → `"kiran"`, `"apple"`, `""`.

`"apply"` and `"apple"` both qualify in the second case; the tie goes to `"apple"`. In the third, `"abc"` fails because `"a"` is missing. A trie makes each check O(len) instead of O(len²) with hashing.

Time: O(Σ len²) with a set, O(Σ len) with a trie  
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
