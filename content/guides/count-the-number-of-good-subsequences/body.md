Given a string, count its non-empty subsequences in which every character that appears occurs the same number of times. Subsequences are counted by the positions chosen, so equal strings taken from different positions count separately. Return the count modulo a large prime, as the official statement gives. For instance, aabb → 11 (all 15 non-empty subsequences except the two aab and the two abb), and abc → 7. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One frequency at a time

1. Count each letter; precompute factorials and inverse factorials up to `n` for `C(c, f)`.
2. For `f = 1 … max count`: `ways = Π (1 + C(cnt[x], f))` over letters, minus 1.
3. Return `Σ ways` under the modulus.

Constructed checks (verified against listing every subsequence on 300 random small strings): aabb → 11, abc → 7.

Every good subsequence has exactly one shared frequency, so no subsequence is counted twice. Subtract the 1 before adding, since choosing no letter at all is empty.

Time: O(26 · n)  
Space: O(n)

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
