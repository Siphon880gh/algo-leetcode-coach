## First root on the path

1. Build a trie from `dictionary`, marking the nodes where a root ends.
2. For each word in the sentence, walk the trie letter by letter:
   - Reaching a marked node: replace the word with the prefix so far (the shortest root).
   - Missing child: keep the word unchanged.
3. Join the words with spaces.

A set of roots also works: for each word, test its prefixes from length 1 upward and stop at the first one in the set. That is O(L²) per word for word length L, because of the slicing.

Do not pick the longest matching root; the problem asks for the shortest. Do not replace when a root is longer than the word; only a prefix of the word can match.

Time: O(total length of the dictionary + sentence)  
Space: O(total length of the dictionary)

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
