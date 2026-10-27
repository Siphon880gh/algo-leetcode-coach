## Linear matching

1. KMP on a + # + s and on b + # + s gives the start lists A and B.
2. Walk A and B together (or binary-search B) and keep i when some B[j] lies in [i − k, i + k].

Examples → [16, 33], [0]. Same code as part I, checked against brute force on 1,500 random strings.

Checking each start directly costs O(n · |a|), up to about 6.25 · 10^10 at these limits (|a| near n / 2).

Time: O(n + |a| + |b|)  
Space: O(n)

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
