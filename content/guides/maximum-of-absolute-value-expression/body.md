## Remove the absolute values

`|a_i − a_j| + |b_i − b_j| + |i − j|` equals the maximum over `p, q ∈ {+1, −1}` of `(p·a_i + q·b_i + i) − (p·a_j + q·b_j + j)`, taking `i ≥ j` without loss of generality (swap if needed).

For each of the four `(p, q)`:

- Compute `v_k = p · arr1[k] + q · arr2[k] + k` for all `k`.
- Candidate = `max(v) − min(v)`.

Return the largest candidate.

The sign on the index can stay `+` because the pair can be taken in either order.

Do not check all pairs; that is O(n²) for n up to 4·10⁴.

Time: O(n)  
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
