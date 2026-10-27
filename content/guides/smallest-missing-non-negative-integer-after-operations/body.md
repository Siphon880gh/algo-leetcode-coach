## Spend remainders

1. `cnt[r]` = how many numbers have `((x mod value) + value) mod value = r`.
2. `m = 0`; while `cnt[m mod value] > 0`: `cnt[m mod value]−−`, `m++`.
3. Return `m`.

Examples → 4, 2. Checked against trying shifts of each number on 200 random small cases.

Negative numbers need the non-negative remainder; in most languages % can return a negative value. The loop runs at most n + 1 times.

Time: O(n + value)  
Space: O(value)

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
