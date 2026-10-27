## Pairwise distances

1. H = {b − a for fences a < b in hFences ∪ {1, m}}; V likewise with {1, n}.
2. If H ∩ V is empty, return −1; else `max(H ∩ V)² mod 10^9 + 7`.

Examples → 4, −1. Checked against trying every set of removed fences on 300 random small fields.

Only adjacent fences would miss removals: example 1 → 1 instead of 4. With about 600 fences each side there are about 1.8 · 10^5 distances. The square can reach about 10^18, which fits in a signed 64-bit integer before the mod.

Time: O(h² + v²)  
Space: O(h² + v²)

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
