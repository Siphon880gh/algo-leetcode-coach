## Three occurrence lists

1. A, B, C = start positions of a, b, c in s.
2. For each j in B: the largest i in A with i + |a| ≤ j; the smallest k in C with k ≥ j + |b| (binary search or pointers).
3. Answer the smallest k + |c| − i, or −1.

Examples → 8, −1, 0, 6. Checked against a regular expression over every substring on 1,500 random cases.

Taking the first a, then the first b and c after it: s = abbba, p = *b* → 2 instead of 1.

Time: O(|s| + |p|) with pointers  
Space: O(|s|)

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
