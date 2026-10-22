## Trie walk plus jumps

1. reach[i] = i + longest prefix of a word matching target at i (walk the trie).
2. Jump game: from the current frontier take the farthest reach; count jumps; −1 if stuck.

Examples → 3, 2, −1. Checked against an O(n²) DP on 300 random cases.

Always jumping to the end of the longest match: words [ba, bb], target bba → −1 instead of 2.

Time: O(n · longest word), at most 5 · 10^3 · 5 · 10^3  
Space: O(total word length)

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
