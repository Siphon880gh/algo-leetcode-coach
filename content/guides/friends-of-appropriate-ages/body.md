## 120 × 120 checks

`cnt[age]` for ages 1 to 120. For each pair `(a, b)`:

- Skip if `b ≤ 0.5 · a + 7` or `b > a`. (The third rule, `b > 100 and a < 100`, is implied by `b > a`.)
- Otherwise add `cnt[a] · cnt[b]`, and if `a == b` subtract `cnt[a]`, since nobody sends a request to themselves.

**Sorting alternative:** sort ages; for each person, binary search the range `(0.5 · a + 7, a]` and subtract 1 for themselves.

Note that anyone aged 14 or younger sends no requests at all, since `0.5 · a + 7 ≥ a`.

Do not compare all pairs of people; `n` can be 2 · 10⁴. Do not forget the self-request when ages are equal.

Time: O(n + 120²)  
Space: O(120)

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
