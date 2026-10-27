## Match suffixes backward

Constructor: insert each word reversed into a trie and record `maxLen`.

`query(letter)`:

1. Append `letter` to the stream; keep only the last `maxLen` letters.
2. Walk the trie from the root over the stream from newest to oldest. If a node marks a word end, return true. If the next letter has no child, return false.
3. Return false when the stream runs out.

Do not keep a set of active prefix pointers for forward words; it works, but the reversed trie keeps each query to one walk of at most `maxLen` steps. Do not keep the whole stream; only the last `maxLen` letters can matter.

Time: O(maxLen) per query  
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
