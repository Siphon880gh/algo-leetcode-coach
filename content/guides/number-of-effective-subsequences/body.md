## Inclusion–exclusion

1. full = OR of nums; B = its set bits; map each value to a B-bit mask.
2. cnt[m] = how many values are submasks of m (subset-sum transform).
3. keep = Σ over m ⊆ full of (−1)^(B − |m|) · 2^cnt[m].
4. Return 2^n − keep mod 10^9 + 7.

Examples → 3, 4, 1, 5. Checked against trying every removal on 1,500 random arrays.

Treating every non-empty removal as effective (2^n − 1): example 1 → 7 instead of 3.

Time: O(n + B · 2^B), B ≤ 20  
Space: O(2^B)

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
