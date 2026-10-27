## Tentative greedy

1. `deposit`: add counts.
2. `withdraw(a)`: for `d` in `500, 200, 100, 50, 20`: `t[d] = min(cnt[d], a / d)`, `a −= t[d] · d`.
3. If `a ≠ 0`, return `[−1]` and keep the counts; otherwise subtract `t` and return it.

Example 1 → `[null,null,[0,0,1,0,1],null,[-1],[0,1,0,0,1]]`.

The machine must take larger notes first even when another mix would work, as the 600 with 200s and a 500 shows. Counts reach 10^9, so `min` keeps the loop O(1).

Time: O(1) per call  
Space: O(1)

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
