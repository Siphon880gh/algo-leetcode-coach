## Two independent multisets

Swaps never move a letter between an even and an odd index, and within each parity any order is reachable. So two words are equivalent exactly when they have the same multiset of even-index letters and the same multiset of odd-index letters.

1. For each word, build `key = (sorted(word[0::2]), sorted(word[1::2]))`, or two 26-letter counts.
2. Add the key to a set.

Return the size of the set.

Do not sort the whole word; that would merge words whose letters sit at different parities. Do not compare all pairs; the signatures make it linear in the input.

Time: O(n · m log m), or O(n · m) with counts  
Space: O(n · m)

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
