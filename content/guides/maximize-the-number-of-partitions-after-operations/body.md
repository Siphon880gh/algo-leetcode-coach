## DFS with memo

1. f(i, mask, can): if i = n, return 1.
2. Letter c: if mask ∪ {c} has more than k letters, a new part starts: `f(i + 1, {c}, can) + 1`; else `f(i + 1, mask ∪ {c}, can)`.
3. If can, also try every letter in place of s[i] with can = false. Return f(0, ∅, true).

Examples → 3, 1, 4. Checked against trying every single change on 300 random small strings.

The change matters: without it example 1 → 1 and example 3 → 3. Before the change the mask is fixed by i, so few states are reachable; on random strings of length 10^4 the memo held at most about 5 · 10^5 states.

Time: O(26 · reachable states)  
Space: O(reachable states)

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
