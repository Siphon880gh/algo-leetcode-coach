## Count passes, then sum them

1. Insert each word; at every node on its path, `count++`.
2. For each word, walk its path again and add up the counts.
3. Return the sums.

Examples → [5,4,3,2], [4].

The count at a node is the score of the prefix it spells. Hashing every prefix as a fresh string costs up to about 1000 · 1000² / 2 = 5 · 10^8 characters, while the trie touches each character twice.

Time: O(total length)  
Space: O(total length)

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
