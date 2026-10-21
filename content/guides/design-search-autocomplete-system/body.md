`AutocompleteSystem(sentences, times)` starts with historical sentences and how often each was typed. `input(c)` receives one character at a time. For a letter or space, return the top 3 historical sentences that start with everything typed so far in this sentence, sorted by count descending, then ASCII order. For `#`, the typed sentence is finished: record it (count + 1), reset, and return `[]`. With "i love you" (5), "island" (3), "ironman" (2), "i love leetcode" (2), typing `i` → `["i love you", "island", "i love leetcode"]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Walk the trie as the user types

**Build:** insert every sentence into a trie; store its count at the end node (or in a map `count[sentence]`).

**Typing:** keep `prefix` (the sentence so far) and `node` (its trie node, or null once no sentence matches).

- Letter or space: append it, step `node` to its child (null if missing). If `node` is null, return `[]`. Otherwise collect the sentences under `node`, sort by `(−count, sentence)`, and return the first 3.
- `#`: add 1 to `count[prefix]` (inserting it into the trie if new), reset `prefix` and `node` to the root, and return `[]`.

To make lookups faster, each trie node can cache its own top-3 list, refreshed along the inserted path on every `#`.

Do not restart from the root on every character; keeping the node pointer makes each step O(1) before collecting. Do not sort by count alone; ties go by ASCII, so "i love leetcode" comes before "ironman".

Time: O(sentences under the prefix · log) per character, or O(1) with cached top-3 lists  
Space: O(total characters)

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
